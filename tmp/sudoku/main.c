/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lucmarti <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/12 09:11:01 by lucmarti          #+#    #+#             */
/*   Updated: 2018/08/12 14:14:26 by hjamet           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_func.h"

char	**init_arrayz(void)
{
	char	**array;
	int		v;
	int		vp;

	v = 0;
	array = malloc(9 * sizeof(char*));
	while (v < 9)
	{
		array[v] = malloc(9 * sizeof(char));
		vp = 0;
		while (vp < 9)
		{
			array[v][vp] = 0;
			++vp;
		}
		++v;
	}
	return (array);
}

void	set_grid(char **grid, char *argv[])
{
	int i;
	int j;

	i = 0;
	while (i < 9)
	{
		j = 0;
		while (j < 9)
		{
			grid[i][j] = argv[i + 1][j] == '.' ? 0 : argv[i + 1][j] - 48;
			j++;
		}
		i++;
	}
}

void	swipe(char **s, char **s2)
{
	ft_swipe(s, 0);
	ft_swipe_rev(s2, 0);
}

int		main(int argc, char *argv[])
{
	char	**sudoku;
	char	**sudoku_rev;

	if (ft_param_valid(argc, argv) == 0)
	{
		ft_putstr("Error\n");
		return (0);
	}
	sudoku = init_arrayz();
	set_grid(sudoku, argv);
	sudoku_rev = init_arrayz();
	set_grid(sudoku_rev, argv);
	if (ft_uniq(sudoku) == 1)
	{
		swipe(sudoku, sudoku_rev);
		if (compare_grid(sudoku, sudoku_rev))
			ft_display(sudoku);
		else
			ft_putstr("Error\n");
	}
	else
		ft_putstr("Error\n");
	free(sudoku);
	free(sudoku_rev);
	return (0);
}
