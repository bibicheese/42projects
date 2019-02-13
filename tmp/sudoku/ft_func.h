/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_func.h                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lucmarti <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/11 15:16:13 by lucmarti          #+#    #+#             */
/*   Updated: 2018/08/12 11:48:54 by lucmarti         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_FUNC_H
# define FT_FUNC_H

# include <unistd.h>
# include <stdio.h>
# include <stdlib.h>

int	ft_param_valid(int argc, char *argv[]);
int	ft_putstr(char *str);
int	compare_grid(char **sudoku, char **sudoku_rev);
int	ft_swipe(char **sudoku, int val);
int	ft_swipe_rev(char **sudoku, int val);
int	ft_display(char **sudoku);
int	ft_is_valid(char **sudoku, int x, int y, char val);
int	ft_uniq(char **sudoku);

#endif
