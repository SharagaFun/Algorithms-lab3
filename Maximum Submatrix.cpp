#include <iostream>
#include <vector>
#include <climits>

std::vector<int> kadane(std::vector<int> &a)
{
    std::vector<int> res = {INT_MIN, 0, -1};
    int sum = 0;
    int start = 0;

    for (int i = 0; i < a.size(); i++)
    {
        sum += a[i];
        if (sum < 0)
        {
            sum = 0;
            start = i + 1;
        }
        else if (sum > res[0])
        {
            res[0] = sum;
            res[1] = start;
            res[2] = i;
        }
    }

    if (res[2] == -1)
    {
        for (int i = 0; i < a.size(); i++)
        {
            if (a[i] > res[0])
            {
                res[0] = a[i];
                res[1] = i;
                res[2] = i;
            }
        }
    }

    return res;
}


int maxSubmatrix(std::vector<std::vector<int>> &matrix)
{
    int maxsum = INT_MIN;
    for (int i = 0; i < matrix[0].size(); i++)
    {
        std::vector<int> best(matrix.size());
        for (int j = i; j < matrix[0].size(); j++)
        {
            for (int k = 0; k < matrix.size(); k++)
            {
                best[k] += matrix[k][j];
            }
            std::vector<int> bestsum = kadane(best);
            if (bestsum[0] > maxsum)
            {
                maxsum = bestsum[0];
            }
        }
    }
    return maxsum;
}

int main()
{
    int x, y;
    std::cin>>x>>y;
    std::vector<std::vector<int>> matrix (x, std::vector <int> (y));
    for (int i=0; i<x; i++)
        for (int j=0; j<y; j++)
            std::cin>>matrix[i][j];
    std::cout << "Max submatrix: " << maxSubmatrix(matrix);

}
